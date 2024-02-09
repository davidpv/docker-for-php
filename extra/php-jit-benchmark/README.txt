PHP 7.4:
docker build -f Dockerfile.php7.4 -t php74-benchmark .
docker run php74-benchmark

PHP 8.3 sin JIT:
docker build -f Dockerfile.php8.3-nojit -t php83-nojit-benchmark .
docker run php83-nojit-benchmark

PHP 8.3 con JIT:
docker build -f Dockerfile.php8.3-jit -t php83-jit-benchmark .
docker run php83-jit-benchmark