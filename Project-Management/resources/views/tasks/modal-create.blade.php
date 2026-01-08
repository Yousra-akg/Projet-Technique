<div class="modal fade" id="addTaskModal" tabindex="-1">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('tasks.store') }}"
              enctype="multipart/form-data"
              class="modal-content">
            @csrf

            <div class="modal-header">
                <h5 class="modal-title">Ajouter une tâche</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="mb-3">
                    <label>Titre</label>
                    <input type="text" name="title" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Description</label>
                    <textarea name="description" class="form-control"></textarea>
                </div>

                <div class="mb-3">
                    <label>Projet</label>
                    <select name="project_id" class="form-control" required>
                        @foreach($projects as $project)
                            <option value="{{ $project->id }}">
                                {{ $project->title }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label>Image</label>
                    <input type="file" name="image" class="form-control">
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button class="btn btn-primary">Enregistrer</button>
            </div>
        </form>
    </div>
</div>
