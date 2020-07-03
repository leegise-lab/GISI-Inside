const express = require('express')

const socket = require('socket')

const http = require('http')

const app = express()

const server = http.createServer(app)

const io = socket(server)

server.listen(8080, function() {
    console.log('서버 실행 중..')
})