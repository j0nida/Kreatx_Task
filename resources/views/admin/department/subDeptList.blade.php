@foreach ($subDept as $sub)
    <ul>
        <a href="{{ route('dept.users', $sub->id) }}">
            <li>{{ $sub->name }}</li>
        </a>
        @if (count($sub->children))
            @include('admin.department.subDeptList',['subDept' => $sub->children])
        @endif
    </ul>
@endforeach
