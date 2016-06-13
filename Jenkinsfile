node('CI_Node'){
   
   try {
		// Mark the code checkout 'stage'....
		stage 'Checkout'
		// Get some code from a GitHub repository
		checkout scm
		
			//   git([url: 'git@github.com:Breakthrough-Technologies/eMPower-TAP.git', branch: 'develop'])

		echo 'Checkout Stage Done!'
		// Get the maven tool.
		// ** NOTE: This 'M3' maven tool must be configured
		// **       in the global configuration.           
		//   def mvnHome = tool 'M3'

		// Mark the code build 'stage'....
		stage 'Build'
		// 	Run the maven build
		//  sh "${mvnHome}/bin/mvn clean install"
		
		def foo = '/usr/local/bin/composer'
		sh "command -v ${foo} >/dev/null 2>&1 || { echo >&2 \"I require ${foo} but it s not installed.  Aborting.\"; }"
		
		sh "/usr/local/bin/composer update --no-scripts"
		echo 'Build Stage Done!'
		
		stage 'Test'
		sh "vendor/bin/phpunit tests/BasicTest.php"
		
		stage 'Upload to S3'
		// zip -r $BUILD_ID.zip *
	
	} catch (Exception e) {
		error "Operation failed: ${e}"
	}
	
}