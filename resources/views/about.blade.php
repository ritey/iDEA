@extends('layouts.app')

@section('metas')
<title>About {{ config('app.name', 'Laravel') }}</title>
@endsection

@section('content')
<div id="about-idea">
    <div class="d-flux container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-10 text-white content text-center">
                <h1 class="title text-center">About <span class="i">i</span>DEA</h1> 
                <p>iDEA is an international <a href="https://drive.google.com/open?id=1Mxf9js2Uip0matl9NRz_jfEpZJI0RJ8L">programme</a> that helps you develop digital, enterprise and employability skills for free. Through our series of online challenges, you can win career-enhancing badges, unlock new opportunities and, ultimately, gain industry recognised awards that help you stand out from the crowd.</p>
                <div class="row text-center launchers">
                    <div class="col-sm-4">
                        <a href="/about/learner" title="I AM A LEARNER" class="launcher-btn">I AM A LEARNER</a>
                    </div>
                    <div class="col-sm-4">
                        <a href="/about/organiser" title="I AM AN ORGANISER" class="launcher-btn">I AM AN ORGANISER</a>
                    </div>
                    <div class="col-sm-4">
                        <a href="/about/partner" title="I AM A PARTNER" class="launcher-btn">I AM A PARTNER</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection