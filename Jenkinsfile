node {
    stage('Install dependencies & build') {
        sh 'composer install --no-dev' 
    }
    stage('Test') {
        sh 'php test'
    }
    stage('Deploy') {
        sh 'sudo cp -r ./ /var/www/html/'
    }
}