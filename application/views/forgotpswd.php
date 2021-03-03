<html>
<head>
	<title>LOGIN</title>
	<link rel="stylesheet" type="text/css" href="<?php echo  base_url('/css/login.css');?>" media="all"/>
	
	
	<meta charset=utf-8>
            <meta name="viewport" content="width=device-width,initial-scale=1">
            <!---Fontawesome--->
            <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
            <!---Bootstrap5----->
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
            <!---custom style---->
            <link rel="stylesheet" href="css/style.css">
    </head>
<body>
<div class="container">
		
		<form class="form-horizontal well" method="post" id="form" action="<?php echo base_url()?>main1/ForgotPassword">
			<fieldset>
	          <legend>Reset password</legend>
			
				<div class="control-group">
					<label for="email"> Email</label>
					<input class="box" type="text" id="email" name="email" />
				</div>
				<div class="form-actions">
					<input type="submit" class="btn btn-primary" value="Reset" />
				</div>
				<?php if( isset($info)): ?>
					<div class="alert alert-success">
						<?php echo($info) ?>
					</div>
				<?php elseif( isset($error)): ?>
					<div class="alert alert-error">
						<?php echo($error) ?>
					</div>
				<?php endif; ?>
				
			</fieldset>
		</form>
	</div>
	</body>
	</html>
