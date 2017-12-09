<?php

/**
 * @Author: lenovo
 * @Date:   2017-10-22 19:54:35
 * @Last Modified by:   lenovo
 * @Last Modified time: 2017-10-22 19:55:31
 */
session_start();
session_destroy();
header('location:login.html');