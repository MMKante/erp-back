pipeline {
    agent any 
    stages {
        stage('Install dependencies & build') {
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
            steps{
                ansiblePlaybook disableHostKeyChecking: true, installation:'ansible2',inventory:'hosts.txt',playbook:'ansible.yml'
            }
        }
    }
}