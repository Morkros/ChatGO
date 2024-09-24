/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    forceTLS: true
});
Pusher.logToConsole = true;

// window.Echo.channel('chatgo')
//     .listen('MessageSend', (data) => {
//         alert(JSON.stringify(data));
//     });
window.Echo.channel('chatgo')
   .listen('.MessageSend', (event) => {
    console.log('Message received:', event.message);
    if (window.Livewire) {
        const messageJson = JSON.stringify(event.message);
        alert(JSON.stringify(messageJson));
        window.Livewire.dispatch('MessageSend', { mensaje: messageJson });
    } else {
        console.error('Livewire is not available');
    }})

    .listen('.Refresh', () => {
        if (window.Livewire) {
        console.log('Refresh');
            window.Livewire.dispatch('Refresh');
        } else {
            console.error('Livewire is not available');
        }
});