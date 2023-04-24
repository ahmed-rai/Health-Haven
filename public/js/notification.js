// assets/js/notification.js
import Pusher from '@pusher/pusher-js';

const pusher = new Pusher('your_app_key', {
    cluster: 'your_app_cluster',
});

const channel = pusher.subscribe('notification-channel');
channel.bind('notification-event', function (data) {
    alert(JSON.stringify(data));
});
