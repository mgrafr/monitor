lgtv = require("lgtv");
var tv_ip_address = "192.168.1.24";
lgtv.connect(tv_ip_address, function(err, response){
  if (!err) {
    lgtv.show_float("It works!", function(err, response){
      if (!err) {
        lgtv.disconnect();
      }
    }); // show float
  }
}); // connect