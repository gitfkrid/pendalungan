node {
    checkout scm

    // deploy env dev
    stage("Build"){
        docker.image('shippingdocker/php-composer:8.2').inside('-u root') {
            sh 'rm composer.lock'
            sh 'composer install'
        }
    }

    // Testing
    stage("Test"){
        docker.image('php:8.2-cli').inside('-u root') {
            sh 'php artisan test --testsuite=Unit'
        }
    }

    // deploy env dev
    stage("Deploy"){
        docker.image('agung3wi/alpine-rsync:1.1').inside('-u root') {
            sshagent (credentials: ['ssh-prod']) {
                sh 'mkdir -p ~/.ssh'
                sh 'ssh-keyscan -H "$PROD_HOST" > ~/.ssh/known_hosts'
                sh "rsync -rav --delete ./ ubuntu@$PROD_HOST:/home/ubuntu/dev.kelasdevops.xyz/ --exclude=.env --exclude=storage --exclude=.git"            }
        }
    }

    // Testing Kedua
    stage("Test"){
        docker.image('agung3wi/alpine-rsync:1.1').inside('-u root') {
            sshagent (credentials: ['ssh-prod']) {
                sh 'mkdir -p ~/.ssh'
                sh 'ssh-keyscan -H "$PROD_HOST" > ~/.ssh/known_hosts'
                sh "ssh ubuntu@$PROD_HOST 'cd /home/ubuntu/dev.kelasdevops.xyz/ && php artisan test --testsuite=Feature'"
            }
        }
    }

    // deploy env prod
    stage("Deploy"){
        docker.image('agung3wi/alpine-rsync:1.1').inside('-u root') {
            sshagent (credentials: ['ssh-prod']) {
                sh 'mkdir -p ~/.ssh'
                sh 'ssh-keyscan -H "$PROD_HOST" > ~/.ssh/known_hosts'
                sh "rsync -rav --delete ./ ubuntu@$PROD_HOST:/home/ubuntu/prod.kelasdevops.xyz/ --exclude=.env --exclude=storage --exclude=.git"            }
        }
    }
}
