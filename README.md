# SpringPHP - 高性能 Swoole 框架

SpringPHP is a high-performance framework based on Swoole.

# About Project

SpringPHP is my first framework and also the precipitation of my own technology.

# TODO
- [x] MVC
- [x] Custom routing
- [x] Support for file-based session components
- [x] RPC、WebSocket RPC
- [x] Timed task
- [x] Support Socket, WebSocket, HTTP
- [x] Support for multiple modules
- [ ] Case practice
- [ ] Improve documentation


# Introduction

It is currently in the testing stage, please use it in the production environment with caution.

# Environment

- PHP >= 7.2

- Swoole >= 4.1.0

# Installation

php composer.phar create-project spring-php/demo [Directory name] [Version]
#### As follows:
```bash
//You can freely delete unwanted code
php composer.phar create-project spring-php/demo demo dev-master
```

# Example

### Start up
```bash
php spring-php start   //Guardian mode needs to add -d after start
```
```

////////////////////////////////////////////////////////////////////
//      ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^        //
//                          SpringPHP                             //
//            https://github.com/1107012776/spring-php            //
////////////////////////////////////////////////////////////////////

```

### Shut down
```bash
php spring-php stop
```

### Restart worker
```bash
php spring-php reload
```

### View program process
```bash
php spring-php process
```

```bash
 spring-php
  \_ spring-php.Manager
  |       \_ spring-php.task.2 pid=29352
  |       \_ spring-php.task.3 pid=29354
  |       \_ spring-php.worker.0 listen:0.0.0.0:7999
  |       \_ spring-php.worker.1 listen:0.0.0.0:7999
  |       \_ spring-php RenderWorker unix worker pid=29363
  |       \_ spring-php RenderWorker unix worker pid=29364
  |       \_ spring-php RenderWorker unix worker pid=29365
  |       \_ spring-php.Crontab worker pid=29368
  \_ spring-php.Manager
  |       \_ spring-php.task.2 pid=29349
  |       \_ spring-php.task.3 pid=29350
  |       \_ spring-php.worker.0 listen:0.0.0.0:8098
  |       \_ spring-php.worker.1 listen:0.0.0.0:8098
  |       \_ spring-php RenderWorker worker pid=29357 listen:0.0.0.0:8099
  |       \_ spring-php RenderWorker worker pid=29369 listen:0.0.0.0:8100
  \_ spring-php.Manager
          \_ spring-php.task.2 pid=29358
          \_ spring-php.task.3 pid=29359
          \_ spring-php.worker.0 listen:0.0.0.0:8297
          \_ spring-php.worker.1 listen:0.0.0.0:8297
          \_ spring-php RenderWorker worker pid=29366 listen:0.0.0.0:8298
          \_ spring-php RenderWorker worker pid=29367 listen:0.0.0.0:8299
```


# Page visitor counter

![visitor counter](https://profile-counter.glitch.me/1107012776_spring-php/count.svg)

