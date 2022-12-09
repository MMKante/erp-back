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
                sh 'sudo ansible-playbook -i hosts.txt ansible.yml'
            }
        }
    }
}