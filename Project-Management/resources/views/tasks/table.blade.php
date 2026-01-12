@foreach($tasks as $task)
<tr>
    <td>{{ $task->title }}</td>
    <td>{{ $task->description }}</td>
    <td>
        @foreach($task->projects as $project)
            <span class="badge bg-secondary">{{ $project->title }}</span>
        @endforeach
    </td>
</tr>
@endforeach
