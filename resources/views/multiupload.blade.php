@extends('layouts.app')

@section('content')

<div class="ui container mt-20">

	<multi-image-upload
		:multi="true"
		:route="'/upload/route'"
		:base-url="'/test/'"
		:image="'image1.jpg'"
		:images="['image1.jpg', 'image2.png']">
	</multi-image-upload>
	
</div>
@endsection