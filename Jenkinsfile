node{
   
   try {
		// Mark the code checkout 'stage'....
		stage 'Checkout'
		// Get some code from a GitHub repository
		checkout scm
		
			//   git([url: 'git@github.com:Breakthrough-Technologies/eMPower-TAP.git', branch: 'develop'])

		echo 'Checkout Stage Done!'

		// Mark the code build 'stage'....
		stage 'Build'
		
		def foo = '/usr/local/bin/composer'
		sh "command -v ${foo} >/dev/null 2>&1 || { echo >&2 \"I require ${foo} but it s not installed.  Aborting.\"; }"
		
		sh "/usr/local/bin/composer update --no-scripts"
		echo 'Build Stage Done!'
		
		stage 'Test'
		sh "vendor/bin/phpunit tests/BasicTest.php"
		
		stage 'Upload to S3'
		def buildBucket = 'empower-jenkins-artifacts-devint'
		
		sh "zip -r ${env.BUILD_ID}.zip * "
		sh "aws s3 cp ${env.BUILD_ID}.zip s3://${buildBucket}/jobs/${env.PROJECT_NAME}/${env.BUILD_ID}.zip "
	
	} catch (Exception e) {
		error "Operation failed: ${e}"
	}
	
}