node {
    stage('Install dependencies & build') {
        sh 'composer install --no-dev' 
    }
    stage('Test') {
        sh 'php test'
    }
    stage('Deploy') {
        sh 'ansible-playbook -i hosts.yml ansible.yml'
    }
}