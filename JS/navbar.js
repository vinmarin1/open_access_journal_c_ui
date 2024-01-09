document.getElementById('notification-button').addEventListener('click', function(event){
    const notificationContainer = document.getElementById('nofication-container');

    // Toggle the display property
    notificationContainer.style.display = (notificationContainer.style.display === 'none') ? 'block' : 'none';

    if (notificationContainer.style.display === 'block') {
        notificationContainer.style.position = 'absolute';
        notificationContainer.style.zIndex = '999';
    }
});
