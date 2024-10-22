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
<<<<<<< Updated upstream
    .listen('.MessageSend', (event) => {
        if (event.message.receiver_id == window.userId) {
            console.log("Receptor: ", event.message.receiver_id, " Login: ", window.userId);
            window.Livewire.dispatch('Notification', { mensaje: event });
            if (window.Livewire) {
                const messageJson = JSON.stringify(event.message);
                //alert(JSON.stringify(messageJson));
                //window.Livewire.dispatch('MessageSend', { mensaje: messageJson });
                window.Livewire.dispatch('Refresh');
            } else {
                console.error('Livewire is not available');
            }
        }
    })
    .listen('.Refresh', () => {
=======
   .listen('.MessageSend', (event) => {
    console.log('Message received:', event.message);
    if (window.Livewire) {
        const messageJson = JSON.stringify(event.message);
        alert(JSON.stringify(messageJson));
        window.Livewire.dispatch('MessageSend', { mensaje: messageJson });
    } else {
        console.error('Livewire is not available');
    }})

    .listen('.Refresh', (event) => {
        // Notificacion
        console.log("Notificacion", event.message.transmitter_id != window.userId)
        if (event.message.transmitter_id != window.userId){
            window.Livewire.dispatch('Notification');
        }
        // Refrescar mensajes al enviar un mensaje
>>>>>>> Stashed changes
        if (window.Livewire) {
        console.log('Refresh');
            window.Livewire.dispatch('Refresh');
        } else {
            console.error('Livewire is not available');
        }
});