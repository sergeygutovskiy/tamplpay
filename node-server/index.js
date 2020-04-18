var express = require('express');

const app  = express();
const http = require('http').createServer(app);
app.use(express.urlencoded({ extended: true }));

var io = require('socket.io')(http);

http.listen(8080, function(){
	console.log('listening on ' + 8080);
});

app.get('/', function (req, res) {
  res.send("Hello");
});


var usersInChat = [];

io.on("connection", function(socket){

	socket.on("connect-to-room", (connectionInfo) => {
		usersInChat.push(connectionInfo.userId);
		
		socket.userId = connectionInfo.userId;
		socket.room = connectionInfo.dealId;

		socket.join(socket.room);
		socket.broadcast.to(socket.room).emit("partner-connected");
	});

	socket.on("new-message", (message) => {
		socket.broadcast.to(socket.room).emit("new-message-from-other-user", message);
	});

	socket.on("disconnect", () => {
		usersInChat = usersInChat.filter(u => {
			return u != socket.userId;
		});
	});
});