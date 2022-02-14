<template>
  <div class="modal fade" tabindex="-1" role="dialog" ref="modal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Уведомление об изменении статьи.</h5>
          <button
            type="button"
            class="close"
            data-dismiss="modal"
            aria-label="Close"
            v-on:click="closeModal"
          >
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Название статьи: {{ textMessage.title }}</p>
          <p>Статья до изменения: {{ textMessage.history_before }}</p>
          <p>Статья после изменения: {{ textMessage.history_after }}</p>
          <p>{{ textMessage.action }}</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["subscribe", "user"],
  data() {
    return {
      modalToggle: false,
      textMessage: "",
    };
  },
  mounted() {
    Echo.private("socket." + this.subscribe.id).notification((notification) => {
      setTimeout(() => {
        this.textMessage = notification;
        this.modalToggle = true;
        this.showModal(this.modalToggle);
      }, 1000);
    });
  },
  methods: {
    closeModal: function (event) {
      this.showModal(this.modalToggle);
    },
    showModal: function (val) {
      $(this.$refs.modal).modal(val ? "show" : "hide");
    },
    // showNotification: function (notification) {
    //     return notification;
    // },
  },
};
</script>
