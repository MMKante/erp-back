node {
    stage('Install dependencies & build') {
        sh 'composer install --no-dev' 
    }
    stage('Test') {
        sh 'php test'
    }
    stage('Deploy') {
        ansiblePlaybook (
            become: true,
            playbook: 'ansible.yml',
            inventory: 'hosts.txt'
        )
    }
}