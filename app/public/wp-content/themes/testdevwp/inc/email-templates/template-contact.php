<?php
/**
 * Email template.
 *
 * @package NRJ_Ingenierie
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta name="viewport" content="width=device-width"/>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<title><?php bloginfo( 'name' ); ?></title>
	<style>
		img {
			border: none;
			-ms-interpolation-mode: bicubic;
			max-width: 100%;
		}

		body {
			background-color: #f6f6f6;
			font-family: sans-serif;
			-webkit-font-smoothing: antialiased;
			font-size: 14px;
			line-height: 1.4;
			margin: 0;
			padding: 0;
			-ms-text-size-adjust: 100%;
			-webkit-text-size-adjust: 100%;
		}

		table {
			border-collapse: separate;
			mso-table-lspace: 0;
			mso-table-rspace: 0;
			width: 100%;
		}

		table td,
		table th {
			text-align: left;
			vertical-align: middle;
		}

		table td {
			font-family: sans-serif;
			font-size: 14px;
		}

		.inner-table {
			border: 1px solid #bdbdbd;
			border-collapse: collapse;
			margin-bottom: 15px;
		}

		.inner-table td,
		.inner-table th {
			padding: 5px;
			border: 1px solid #bdbdbd;
		}

		.body {
			background-color: #f6f6f6;
			width: 100%;
		}

		.container {
			display: block;
			margin: 0 auto !important;
			max-width: 580px;
			padding: 10px;
			width: 580px;
		}

		.content {
			box-sizing: border-box;
			display: block;
			margin: 0 auto;
			max-width: 580px;
			padding: 10px;
		}

		.main {
			background: #ffffff;
			border-radius: 3px;
			width: 100%;
		}

		.wrapper {
			box-sizing: border-box;
			padding: 20px;
		}

		.content-block {
			padding-bottom: 10px;
			padding-top: 10px;
		}

		.footer {
			clear: both;
			margin-top: 10px;
			text-align: center;
			width: 100%;
		}

		.footer td,
		.footer p,
		.footer span,
		.footer a {
			color: #999999;
			font-size: 12px;
			text-align: center;
		}

		h1,
		h2,
		h3,
		h4 {
			color: #000000;
			font-family: sans-serif;
			font-weight: 400;
			line-height: 1.4;
			margin: 0;
			margin-bottom: 30px;
		}

		h1 {
			font-size: 30px;
			font-weight: 300;
			text-align: center;
			text-transform: capitalize;
		}

		p,
		ul,
		ol {
			font-family: sans-serif;
			font-size: 14px;
			font-weight: normal;
			margin: 0;
			margin-bottom: 15px;
		}

		p li,
		ul li,
		ol li {
			list-style-position: inside;
			margin-left: 5px;
		}

		a {
			color: #3498db;
			text-decoration: underline;
		}

		.btn > tbody > tr > td {
			padding-bottom: 15px;
		}

		.btn table {
			width: auto;
		}

		.btn table td {
			background-color: #ffffff;
			border-radius: 5px;
			text-align: center;
		}

		.btn a {
			background-color: #ffffff;
			border: solid 1px #3498db;
			border-radius: 5px;
			box-sizing: border-box;
			color: #3498db;
			cursor: pointer;
			display: inline-block;
			font-size: 14px;
			font-weight: bold;
			margin: 0;
			padding: 12px 25px;
			text-decoration: none;
			text-transform: capitalize;
		}

		.btn-primary table td {
			background-color: #3498db;
		}

		.btn-primary a {
			background-color: #D1E19D;
			border-color: #D1E19D;
			color: #000000;
		}

		.preheader {
			color: transparent;
			display: none;
			height: 0;
			max-height: 0;
			max-width: 0;
			opacity: 0;
			overflow: hidden;
			mso-hide: all;
			visibility: hidden;
			width: 0;
		}

		.powered-by a {
			text-decoration: none;
		}

		hr {
			border: 0;
			border-bottom: 1px solid #f6f6f6;
			margin: 20px 0;
		}

		@media only screen and (max-width: 620px) {
			table[class=body] h1 {
				font-size: 28px !important;
				margin-bottom: 10px !important;
			}

			table[class=body] p,
			table[class=body] ul,
			table[class=body] ol,
			table[class=body] td,
			table[class=body] span,
			table[class=body] a {
				font-size: 16px !important;
			}

			table[class=body] .wrapper {
				padding: 10px !important;
			}

			table[class=body] .content {
				padding: 0 !important;
			}

			table[class=body] .container {
				padding: 0 !important;
				width: 100% !important;
			}

			table[class=body] .main {
				border-left-width: 0 !important;
				border-radius: 0 !important;
				border-right-width: 0 !important;
			}

			table[class=body] .btn table {
				width: 100% !important;
			}

			table[class=body] .btn a {
				width: 100% !important;
			}
		}

		@media all {
			.ExternalClass p,
			.ExternalClass span,
			.ExternalClass font,
			.ExternalClass td,
			.ExternalClass div {
				line-height: 100%;
			}

			.apple-link a {
				color: inherit !important;
				font-family: inherit !important;
				font-size: inherit !important;
				font-weight: inherit !important;
				line-height: inherit !important;
				text-decoration: none !important;
			}

			#MessageViewBody a {
				color: inherit;
				text-decoration: none;
				font-size: inherit;
				font-family: inherit;
				font-weight: inherit;
				line-height: inherit;
			}

			.btn-primary table td:hover {
				background-color: #34495e !important;
			}

			.btn-primary a:hover {
				background-color: #34495e !important;
				border-color: #34495e !important;
				color: #ffffff !important;
			}
		}
	</style>
</head>
<body class="">
<span class="preheader"><?php bloginfo( 'name' ); ?></span>
<table role="presentation" class="body">
	<tr>
		<td>&nbsp;</td>
		<td class="container">
			<div class="content">
				<table role="presentation" class="main">
					<tr>
						<td class="wrapper">
							<table role="presentation">
								<tr>
									<td>
										<h1><?php esc_html_e( 'Contact Form', 'nrj-ingenierie' ); ?></h1>

										<?php
										if ( ! empty( $first_name ) ) {
											printf(
												'<p><strong>%1$s : </strong> %2$s</p>',
												esc_html__( 'First name', 'nrj-ingenierie' ),
												$first_name
											);
										}

										if ( ! empty( $last_name ) ) {
											printf(
												'<p><strong>%1$s : </strong> %2$s</p>',
												esc_html__( 'Last name', 'nrj-ingenierie' ),
												$last_name
											);
										}

										if ( ! empty( $email ) ) {
											printf(
												'<p><strong>%1$s : </strong> %2$s</p>',
												esc_html__( 'Email', 'nrj-ingenierie' ),
												$email
											);
										}

										if ( ! empty( $phone ) ) {
											printf(
												'<p><strong>%1$s : </strong> %2$s</p>',
												esc_html__( 'Phone', 'nrj-ingenierie' ),
												$phone
											);
										}

										if ( ! empty( $how_know ) ) {
											printf(
												'<p><strong>%1$s : </strong> %2$s</p>',
												esc_html__( 'How did you know us?', 'nrj-ingenierie' ),
                                                $how_know
											);
										}

										if ( ! empty( $object ) ) {
											printf(
												'<p><strong>%1$s : </strong> %2$s</p>',
												esc_html__( 'Object', 'nrj-ingenierie' ),
                                                $object
											);
										}

										if ( ! empty( $message ) ) {
											printf(
												'<p><strong>%1$s : </strong> %2$s</p>',
												esc_html__( 'Message', 'nrj-ingenierie' ),
												$message
											);
										}
										?>
									</td>
								</tr>
								<?php if ( ! empty( $cta ) ) : ?>
									<tr>
										<td>
											<table role="presentation" class="btn btn-primary">
												<tbody>
												<tr>
													<td><a href="<?php echo $cta['url']; ?>"><?php echo $cta['text']; ?></a></td>
												</tr>
												</tbody>
											</table>
										</td>
									</tr>
								<?php endif; ?>
							</table>
						</td>
					</tr>
				</table>
				<div class="footer">
					<table role="presentation">
						<tr>
							<td class="content-block">
								<a href="<?php echo home_url(); ?>" class="apple-link"><?php bloginfo( 'name' ); ?></a>
							</td>
						</tr>
					</table>
				</div>
			</div>
		</td>
		<td>&nbsp;</td>
	</tr>
</table>
</body>
</html>
