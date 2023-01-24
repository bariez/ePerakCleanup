self.addEventListener('push', function (e) {
    if (!(self.Notification && self.Notification.permission === 'granted')) {
        //notifications aren't supported or permission not granted!
        return;
    }

    if (e.data) {
        var msg = e.data.json();
        var rUrl = msg.data.url;
        e.waitUntil(self.registration.showNotification(msg.title, {
            body: msg.body,
            icon: msg.icon,
            actions: msg.actions,
            data: {
                      redirectUrl : rUrl
                }
        }));
    }


});


 self.addEventListener('notificationclick', function(event) {

  var urls = event.notification.data.redirectUrl;
  if (!event.action) {

     
      const promiseChain = clients.openWindow(urls);
    event.waitUntil(promiseChain);
    return;
  }else{

      const promiseChain = clients.openWindow(urls);
    event.waitUntil(promiseChain);
    return;
  }

  });