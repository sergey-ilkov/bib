@extends('account.layouts.widget')


@push('js')
<script src="{{ asset('js/account/widget-bank-statement.js') }}" defer></script>
@endpush


@section('content')


@php


@endphp


<section class="configurator">

    <div class="widget-panel">

    </div>
    <div class="widget-preview">

        <div class="widget-preview-wrap">

            {{-- ? bibber-widget --}}
            <div class="bibber-app" data-bibber-app="{{ $widget->uid}}">
                <div class="bibber-widget">
                    <div class="bibber-widget-header">
                        <div class="bibber-widget-title">Upload a bank statement</div>
                        <div class="bibber-widget-subtitle">( probability of loan approval +35% )</div>
                    </div>

                    <div class="bibber-widget-requirements">
                        <div class="bibber-widget-requirements-title">Requirements:</div>
                        <div class="bibber-widget-requirements-text">1. Attach a certificate from your bank (unmodified PDF file).</div>
                        <div class="bibber-widget-requirements-text">2. The bank statement must be from the last 3 months or more.</div>
                    </div>
                    <form class="bibber-widget-form">

                        <div class="bibber-app-checkbox-wrap">
                            <button class="bibber-app-checkbox">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"></path>
                                </svg>
                            </button>
                            <span class="bibber-app-checkbox-text">Consent to information processing</span>
                        </div>

                        <div class="bibber-app-file-data">
                            <span class="bibber-app-file-label">File:</span>
                            <span class="bibber-app-file-value">dfdfd.pdf</span>
                        </div>

                        <div class="bibber-app-message">Error send file</div>

                        <div class="bibber-app-file-wrap">

                            <div class="bibber-app-dropzone">
                                <label class="bibber-app-file-btn">
                                    <input class="bibber-app-file-input" type="file" name="file" accept=".pdf">
                                    <span class="bibber-app-btn-bg bibber-app-btn-text-wrap">
                                        <span class="btn-text-accent">Choose file</span>
                                        <span>or drop here</span>
                                    </span>
                                </label>
                            </div>

                            <div class="bibber-app-analize-file">
                                <div class="bibber-app-analize-file-title">Analize file</div>
                                <div class="bibber-app-analize-data">
                                    <span>Page</span>
                                    <span class="bibber-app-analize-current-page"></span>
                                    <span>of</span>
                                    <span class="bibber-app-analize-total-pages"></span>
                                </div>
                                <span class="bibber-app-analize-loader"></span>
                            </div>

                        </div>



                        <button class="bibber-app-btn-send" disabled>
                            <span class="bibber-app-btn-bg">
                                <span class="bibber-app-btn-loader-wrap">
                                    <span class="bibber-app-btn-loader"></span>
                                </span>
                                <span class="bibber-app-btn-text">Send</span>
                            </span>
                        </button>

                    </form>

                </div>
            </div>

            {{-- ? bibber-widget --}}





        </div>

    </div>






    <div class="viewport">
        <svg class="svg-desktop" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
            <path fill-rule="evenodd" d="M19 3a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-6.401v1.9H15a.6.6 0 0 1 .097 1.192L15 20.1H9a.6.6 0 0 1-.097-1.192L9 18.9h2.399V17H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h14Zm0 1H5a1 1 0 0 0-.993.883L4 5v9a1 1 0 0 0 .883.993L5 15h14a1 1 0 0 0 .993-.883L20 14V5a1 1 0 0 0-1-1Z"></path>
        </svg>
        <svg class="svg-mobile" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
            <path fill-rule="evenodd" d="M15 3a2 2 0 0 1 2 2v13a2 2 0 0 1-2 2H9a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h6Zm-3 14.5a1 1 0 1 0 0 2 1 1 0 0 0 0-2ZM15 4H9a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V5a1 1 0 0 0-1-1Z"></path>
        </svg>
    </div>
</section>






@endsection