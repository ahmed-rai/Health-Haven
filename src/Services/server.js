const express = require('express');
const http = require('http');
const socketIO = require('socket.io');

const app = express();
const server = http.createServer(app);
const io = socketIO(server);

// Listen for new connections
io.on('connection', (socket) => {
  console.log('A user connected');

  // Listen for 'quizApprovedByAdmin' event from the admin
  socket.on('quizApprovedByAdmin', (data) => {
    // Emit the 'quizApproved' event to all connected clients
    io.emit('quizApproved', { message: 'A quiz has been approved by the admin.' });
  });

  // Handle disconnection
  socket.on('disconnect', () => {
    console.log('A user disconnected');
  });
});

server.listen(3000, () => {
  console.log('Server listening on port 3000');
});
