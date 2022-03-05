const notificationsWrapper = $('.alert-dropdown');
const notificationsToggle = notificationsWrapper.find('a[data-toggle]');
const notificationsCountElem = notificationsToggle.find('span[data-count]');
const notificationsCount = parseInt(notificationsCountElem.data('count'));
const notifications = notificationsWrapper.find('div.alert-body');

// Subscribe to the channel we specified in our Laravel Event
const channel = pusher.subscribe('real-notification');
// Bind a function to an Event (the full Laravel class)
channel.bind('App\\Events\\RealNotification', function(data) {
  const existingNotifications = notifications.html();
})