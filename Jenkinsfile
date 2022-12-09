pipeline {
    agent any 
    stages {
        stage('Install dependencies') {
            steps {
                sh 'composer install' 
            }
        }
        stage('Test') {
            steps {
                sh 'php test'
            }
        }
        stage('Deploy') {
            echo 'Deploying...'
        }
    }
}