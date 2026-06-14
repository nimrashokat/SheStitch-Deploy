const express = require("express");
const http = require("http");
const { Server } = require("socket.io");
const cors = require("cors");

const app = express();
app.use(cors());
app.use(express.json());

const server = http.createServer(app);
const io = new Server(server, { cors: { origin: "*" } });

const users = new Map();

io.on("connection", (socket) => {
  socket.on("join", ({ userId, name, role }) => {
    users.set(socket.id, { userId, name, role, online: true });
    io.emit("online-users", Array.from(users.values()));
  });

  socket.on("send-message", (payload) => {
    io.emit("receive-message", {
      ...payload,
      createdAt: new Date().toISOString(),
    });
  });

  socket.on("disconnect", () => {
    users.delete(socket.id);
    io.emit("online-users", Array.from(users.values()));
  });
});

app.get("/", (_, res) => {
  res.json({ app: "SheStitch Chat Server", status: "running" });
});

server.listen(4000, () => {
  console.log("SheStitch chat server running on http://localhost:4000");
});
