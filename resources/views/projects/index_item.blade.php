<tr>
    <td><a href="{{ route('projects.edit', compact('project')) }}">{{ $project->name }}</a></td>
    <td>{{ $project->portfolio->name }}</td>
    <td>{{ __(App\Project::STATUS[$project->status]) }}</td>
    <td>{{ $project->formatted_score }}</td>
    <td>{{ __(App\Project::TYPES[$project->type]) }}</td>
</tr>
