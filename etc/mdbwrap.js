var http = require('http');
 
http.createServer(function (req, res) {
  global.res = res;
  res.writeHead(200, { 'Content-Type': 'application/json' });
  var xreq = http.request('http://localhost:28017' + req.url, function(xresp) {
    var content = '';
    xresp.on('data', function (chunk) {
      content += chunk;
    });

    xresp.on( 'end' , function() {
      global.res.write(content);
      global.res.end();
    });
  });

  xreq.end();
}).listen(9000);
