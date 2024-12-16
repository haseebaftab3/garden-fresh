<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Account</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container mt-5">
        <section class="mb-4">
            <header>
                <h3>
                    Delete Account
                </h3>
                <p class="mt-2 text-muted">
                    Once your account is deleted, all of its resources and data will be permanently deleted. Before
                    deleting your account, please download any data or information that you wish to retain.
                </p>
            </header>

            <button type="button" class="btn py-4 btn-danger" data-bs-toggle="modal"
                data-bs-target="#confirmUserDeletionModal">
                Delete Account
            </button>

            <!-- Modal -->
            <div class="modal fade" id="confirmUserDeletionModal" tabindex="-1"
                aria-labelledby="confirmUserDeletionModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form method="post" action="{{ route('profile.destroy') }}">
                            @csrf
                            @method('delete')

                            <div class="modal-header">
                                <h5 class="modal-title" id="confirmUserDeletionModalLabel">
                                    Are you sure you want to delete your account?
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>

                            <div class="modal-body">
                                <p class="text-muted">
                                    Once your account is deleted, all of its resources and data will be permanently
                                    deleted. Please enter your password to confirm you would like to permanently delete
                                    your account.
                                </p>

                                <div class="mb-3 form-group">
                                    <label for="password" class="form-label visually-hidden">Password</label>
                                    <input type="password" class="form-control" id="password" name="password"
                                        placeholder="Password">
                                    @if ($errors->userDeletion->has('password'))
                                        <div class="text-danger mt-2">
                                            {{ $errors->userDeletion->first('password') }}
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="axil-btn btn-bg-light"
                                    data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="axil-btn bg-danger text-white">Delete Account</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
</body>

</html>
