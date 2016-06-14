node{
   
   try {
		// Mark the code checkout 'stage'....
		stage 'Checkout'
		// Get some code from a GitHub repository
		checkout scm
		
		// git([url: 'git@github.com:Breakthrough-Technologies/eMPower-TAP.git', branch: 'develop'])

		echo 'Checkout Stage Done!'

		// Mark the code build 'stage'....
		stage 'Build'
		
		def foo = '/usr/local/bin/composer'
		sh "command -v ${foo} >/dev/null 2>&1 || { echo >&2 \"I require ${foo} but it s not installed.  Aborting.\"; }"
		
		sh "${foo} update --no-scripts"
		echo 'Build Stage, Done!'
		
		stage 'Test'
		sh "vendor/bin/phpunit tests/BasicTest.php"
		echo 'Test Stage, Done!'
		
		stage 'Upload to S3'
		def buildBucket = 'empower-jenkins-artifacts-devint'
		
		sh "zip -r ${env.BUILD_ID}.zip * "
		echo 'Compression of the build Done!'
		
		sh "aws s3 cp ${env.BUILD_ID}.zip s3://${buildBucket}/jobs/${env.JOB_NAME}/${env.BUILD_ID}.zip "
		echo 'Uploading to S3, Done!'
	
	} catch (Exception e) {
		error "Operation failed: ${e}"
	}
	
}