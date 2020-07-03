var express = require('express');
var app = express();

//app을 http에 연결시키고 http를 socket.io에 연결시키는 과정 ( socket.io가 express를 직접 받지 못하기 때문)
//socket.io는 io라는 변수명으로 서버에서 사용됨
var http = require('http').Server(app); //1
var io = require('socket.io')(http); //1

//모든 request는 client.html을 response하도록 설정
app.get('/',function (req, res) { //2
    res.sendFile( __dirname +'/client.html');
});

var firstname = "블링블링/헤진/신상/짭퉁/버려진/갖고싶은/불매중인/상처난/S급/식상한";
var lastname = "유니클로/나이키/아디다스/퓨마/언더아머/프라다/구찌/샤넬/버버리/입생로랑";


var firstArray = firstname.split('/');
var lastArray = lastname.split('/');



//사용자가 웹에 접속하면 socket.io에 의해 connection이 자동 발생.
//io.on(이벤트, 함수)는 서버에 전달된 이벤트를 인식해 함수를 실행시키는 이벤트 리스너.
io.on('connection', function (socket) { //3
    var first = Math.floor(Math.random() * 10);
var last = Math.floor(Math.random() * 10);
    //connection 이벤트 리스너에 이벤트가 발생하면 한번만 일어나는 코드들.
    console.log('user connected: ', socket.id); //3-1
    var name = firstArray[first]+" "+lastArray[last];               //3-1
    io.to(socket.id).emit('change name', name); //3-1

    //접속자의 접속이 해제되는 경우 디스커넥트 이벤트 자동 발생.
    socket.on('disconnect', function () { //3-2
        console.log('user disconnected: ', socket.id);
    });

    //socket.io를 사용한 send message이벤트의 리스너. 채팅 주고 받음
    socket.on('send message', function (name, text) { //3-3
        var msg = name + ' : ' + text;
        console.log(msg);
        io.emit('receive message', msg);
    });
});

http.listen(3000, function () { //4
    console.log('server on!');
});
