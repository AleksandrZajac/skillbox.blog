// Echo
//     .channel('channel-name')//название канала SomethingHappens
//     .listen('SomethingHappens', (e) => {
//         // console.log(e.whatHappens); //название публичных переменных класса SomethingHappens
//         alert(e.what);//ключи из функции broadcastWith()
//     });

//код переносим в компонент vue
// Echo
//     .private('article.1')//1 id статьи
//     .listen('event', (data) => {
//         console.log(data);
//     });

// if (null !== userId) {
// Echo.private('App.Models.User.' + userId)
//     .notification((notification) => {
//         alert(notification.type + ': ' + notification.line);
//     });
// }

// Echo.private('socket.' + 1)
//     .notification((notification) => {
//         alert(notification.type + ': ' + notification.line);
//     });

