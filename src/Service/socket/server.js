const express = require('express');
const app = express();
const server = require('http').Server(app);
const io = require('socket.io')(server);

// Replace with your desired port
const port = 3000;

app.use(express.static('public'));

io.on('connection', (socket) => {
    console.log('A user connected');

    // Here you can emit custom events, like 'quizApproved'
    // For example:
    // socket.emit('quizApproved', { message: 'A quiz has been approved!' });

    socket.on('disconnect', () => {
        console.log('A user disconnected');
    });
});

server.listen(port, () => {
    console.log(`WebSocket server is running at http://localhost:${port}`);
});
