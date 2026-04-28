@if ($data['agent_registration_section']['status'] == '1')
<div class="container mt-5">
    <section class="cta-section custom-bg-img" data-bg-img="{{dynamicStorage(path: 'storage/app/public/landing-page/agent-registration/'. $data['agent_registration_section']['data']['banner'])}}">
            <div class="row gy-2 align-items-center justify-content-between px-4">
                <div class="col-12">
                    <div
                        class="cta-title cta-title-sm lh-sm mb-30 text-center text-sm-start">{!! change_text_color_or_bg($data['agent_registration_section']['data']['title']) !!}</div>
                    @php
                        $agent_self_reg_status = App\Models\BusinessSetting::where(['key' => 'agent_self_registration'])->first()?->value ?? 0
                    @endphp
                    @if ($agent_self_reg_status == 1)
                        <div class="d-flex justify-content-center justify-content-sm-start">
                            <button class="btn btn-dark"><a class="text-white"
                                                            href="{{route('agent.agent-self-registration')}}">{{translate('Join Now')}}</a>
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    </div>
@endif
