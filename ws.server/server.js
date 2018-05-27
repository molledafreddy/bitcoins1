
var io = require('socket.io')(6001),
Redis = require('ioredis'),
redis = new Redis();

redis.psubscribe('*', function(error, count){
	// console.log('conectado con redis', count);
});

redis.on('error', function (error){
	console.dir(error);
});

io.on('connection', function(socket){
  console.log('user connected');
	socket.on('room', function(data) {
    console.log(data);
 	});
	redis.on('pmessage', function(pattern, channel, message){
		message = JSON.parse(message);
		io.emit(channel+ ':' + message.event, message.data.message);
		// console.log( channel, message);
	});
})

redis.on('pmessage', function(pattern, channel, message){

	message = JSON.parse(message);
	io.emit(channel+ ':' + message.event, message.data.message);
	console.log( channel, message);

});

