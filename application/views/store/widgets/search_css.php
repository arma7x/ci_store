<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<style>
	.pagination {
		position: relative;
		z-index: 1;
		justify-content: flex-end !important;
	}
	.pagination .page-item .page-link,
	.pagination .page-item .page-link a {
		width: 40px;
		height: 40px;
		border: none;
		font-size: 16px;
		font-weight: 400;
		line-height: 40px;
		padding: 0;
		text-align: center;
		color: #242424;
	}
	.pagination .page-item .page-link:hover,
	.pagination .page-item .page-link:focus,
	.pagination .page-item .page-link:hover a,
	.pagination .page-item .page-link:focus a {
		color: #fff;
		box-shadow: none;
		background-color: var(--pink)!important;
	}
	.pagination .page-item.active .page-link {
		color: #fff;
		box-shadow: none;
		background-color: var(--pink)!important;
	}
	.pagination .page-item:first-child .page-link {
		margin-left: 0;
		border-top-left-radius: 0;
		border-bottom-left-radius: 0;
	}
	.pagination .page-item:last-child .page-link {
		margin-left: 0;
		border-top-right-radius: 0;
		border-bottom-right-radius: 0;
	}
</style>
