<!--user-->
@foreach($assigned as $user)
    <span 
        class="x-assigned-user js-card-settings-button-static card-lead-assigned card-assigned-listed-user" tabindex="0"
        data-user-id="{{ $user->user_id }}" data-popover-content="card-lead-team" 
        data-title="{{ cleanLang(__('lang.assign_users')) }}" data-toggle="tooltip" 
        data-placement="top" title="{{ $user->first_name }}">
        <img src="{{ getUsersAvatar($user->avatar_directory, $user->avatar_filename) }}" data-placement="top"
            alt="{{ $user->first_name }}" class="img-circle avatar-xsmall">
        <span>Leads: <strong>{{ $user->total_leads }}</strong></span>
    </span>
@endforeach
<!--user-->