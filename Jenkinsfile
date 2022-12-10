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
                sh 'ansible-playbook -i /home/mmk/ansible/hosts.txt ansible.yml'
            }
        }
    }
}