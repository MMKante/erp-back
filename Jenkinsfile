pipeline {
    agent any

    stages {
        stage('Install prod dependencies') {
            steps {
                sh 'composer install --no-dev' 
            }
        }
        stage('Test') {
            steps {
                sh 'php test'
            }
        }
        stage('Deploy') {
            steps {
                sh 'echo "Deploying..."'
                sh 'pwd'
            }
        }
    }
}