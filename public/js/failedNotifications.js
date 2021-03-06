 notificationsWrapper = $('.alert-dropdown');
 notificationsToggle = notificationsWrapper.find('a[data-toggle]');
 notificationsCountElem = notificationsToggle.find('span[data-count]');
 notificationsCount = parseInt(notificationsCountElem.data('count'));
 notifications = notificationsWrapper.find('div.alert-body');

// Subscribe to the channel we specified in our Laravel Event
 channel = pusher.subscribe('failed-notification');
// Bind a function to an Event (the full Laravel class)
channel.bind('App\\Events\\FailedNotification', function(data) {
   existingNotifications = notifications.html();
   newNotificationHtml = `<a class="dropdown-item d-flex align-items-center" href="#">
                              <div class="ml-3">
                                  <div class="icon-circle bg-secondary">
                                      <i class="far fa-bell text-white"></i>
                                  </div>
                              </div>
                              <div>
                                  <div class="small text-gray-500">`+data.date+`</div>
                                  <span>للأسف حدث خطأ  أثناء معالجة الفيديو <b>`+data.video_title+`</b>يرجى المحاولة مرة أخرى</span>
                              </div>
                            </a>  `;
  notifications.html(newNotificationHtml + existingNotifications);
  notificationsCount += 1;
  notificationsCountElem.attr('data-count', notificationsCount);
  notificationsWrapper.find('.notif-count').text(notificationsCount);
  notificationsWrapper.show();

})