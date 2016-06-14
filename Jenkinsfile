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
		
		def config = new HashMap()
		def thr = Thread.currentThread()
		def build = thr?.executable
		def buildMap = build.getBuildVariables()
		config.putAll(buildMap)
		def envVarsMap = build.parent.builds[0].properties.get("envVars")
		config.putAll(envVarsMap)

		def jobName = config.get("JOB_NAME")
		def jobURL = build.envVars.BUILD_URL
		def buildId = build.envVars.BUILD_ID
		def projectName = build.envVars.PROJECT_NAME
		echo " ${projectName} ${buildId} ${jobName} ${jobURL} " 
		
		sh "zip -r ${buildId}.zip * "
		sh "aws s3 cp ${buildId}.zip s3://${buildBucket}/jobs/${projectName}/${buildId}/${buildId}.zip"
	
	} catch (Exception e) {
		error "Operation failed: ${e}"
	}
	
}