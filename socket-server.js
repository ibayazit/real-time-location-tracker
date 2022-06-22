const app = require('express')()
const http = require('http').Server(app)
const io = require('socket.io')(http, {
    cors: {
        origin: '*',
    }
})
const Redis = require('ioredis')
const redis = new Redis()

const configs = {
    port: 3000
}

redis.subscribe('private-location', function(err, count) {
    if(err) 
        console.log(err.message)
    else
        console.log('Subscribed. '  + count)
})

redis.on('message', function(channel, message) {
    console.log('Message Recieved: ' + message);
    
    message = JSON.parse(message);

    io.emit(channel + ':' + message.event, message.data);
})

http.listen(configs.port, function(){
    console.log(`Listening on Port ${configs.port}`);
})