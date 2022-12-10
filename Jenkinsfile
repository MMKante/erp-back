node {
    stage('Install prod dependencies') {
        sh 'composer install --no-dev' 
    }
    stage('Test') {
        sh 'php test'
    }
    stage('Deploy') {
        sh 'ansible-playbook -i /home/mmk/ansible/s.txt ansible.yml'
    }
}