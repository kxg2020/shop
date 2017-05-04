<?php
$name = "美女.png";
header("Content-Disposition:attachment;filename={$name}"); //告诉浏览器发送的内容是用来下载的
readfile("111.png");  //读取的内容发送浏览器