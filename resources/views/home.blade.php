@extends('template')
@section('main')
    <main>
        <style>
            .fieldname {
               width: 100%;
               margin-bottom: 20px;
            }
        </style>
        <div style="width: 100%; overflow: hidden;">
            <div style="width: 280px; float: left;">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#formModal"
                    style="width: 100%;">
                    New Project
                </button><br>
                <div style="width: 280px; float: left;">
                    <div style="color: white; background-color: #2471A3; width: 100%;">
                        Deployed (@if ($form_deployed)
                            {{ count($form_deployed) }}
                        @endif)
                    </div>
                    <table style="width: 100%;">
                        @foreach ($form_deployed as $key => $f)
                            <tr>
                                <td @class([
                                    'projects_name',
                                    'projects_name_y' => $key % 2 == 0,
                                    'projects_name_n' => $key % 2 == 1,
                                ])>
                                    <form action="/formpage/{{ $f->id }}" style="float: left; padding-right: 4px;">
                                        <button type="submit" class="btn default">{{ $f->form_name }}</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    <div style="color: white; background-color: #2471A3; width: 100%;">
                        Draft (@if ($form_draft)
                            {{ count($form_draft) }}
                        @endif)
                    </div>
                    <table style="width: 100%;">
                        @foreach ($form_draft as $key => $f)
                            <tr>
                                <td @class([
                                    'projects_name',
                                    'projects_name_y' => $key % 2 == 0,
                                    'projects_name_n' => $key % 2 == 1,
                                ])>
                                    <form action="/formpage/{{ $f->id }}" style="float: left; padding-right: 4px;">
                                        <button type="submit" class="btn default">{{ $f->form_name }}</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    <div style="color: white; background-color: #2471A3; width: 100%;">
                        Archived (@if ($form_arquived)
                            {{ count($form_arquived) }}
                        @endif)
                    </div>
                    <table style="width: 100%;">
                        @foreach ($form_arquived as $key => $f)
                            <tr>
                                <td @class([
                                    'projects_name',
                                    'projects_name_y' => $key % 2 == 0,
                                    'projects_name_n' => $key % 2 == 1,
                                ])>
                                    <form action="/formpage/{{ $f->id }}" style="float: left; padding-right: 4px;">
                                        <button type="submit" class="btn default">{{ $f->form_name }}</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <div style="margin-left: 300px; width: 900px;">
                    @if (isset($form_id))
                        <table style="width: 100%;">
                            <tr>
                                <td>
                                    <h3>{{ $form_id->form_name }}</h3>
                                </td>
                                <td>
                                    <form action="/deployform/" method="post">
                                        @csrf
                                        <input type="hidden" name="form_url_d" value="{{ Request::segment(2) }}" />
                                        <button type="submit" class="btn btn-primary" style="background-color: #2ECC71;">
                                            Deploy
                                        </button>
                                    </form>
                                </td>
                                <td>
                                    <form action="/archiveform/" method="post">
                                        @csrf
                                        <input type="hidden" name="form_url_a" value="{{ Request::segment(2) }}" />
                                        <button type="submit" class="btn btn-primary" style="background-color: #E74C3C;">
                                            Archive
                                        </button>
                                    </form>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#previewModal" style="background-color: #ABB2B9; color: blue;">
                                        Preview
                                    </button>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-primary"
                                        style="background-color: #83A0F7; color: white;">
                                        Data
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    @if ($form_id->form_status == 'deployed')
                                        <a href="/deployed/{{ $form_id->id }}"
                                            style="font-size: 12px; text-decoration: none;">Link form online access</a>
                                    @endif
                                </td>
                            </tr>
                        </table><br>
                        <fieldset style="border: 1px solid white; padding: 20px; background-color: #BFC9CA;">
                            <legend>New Field:</legend>
                            <form action="/submitnewfield" method="post" style="width: 100%">
                                @csrf
                                <table style="width: 100%">
                                    <tr>
                                        <td>
                                            Name:
                                        </td>
                                        <td>
                                            <input type="name" class="form-control" name="field_name" id="field_name"
                                                placeholder="Enter Field Name" style="width: 260px">
                                        </td>
                                        <td>
                                            Label:
                                        </td>
                                        <td>
                                            <input type="name" class="form-control" name="field_label" id="field_label"
                                                placeholder="Enter name" style="width: 260px">
                                        </td>
                                        <td>
                                            Type:
                                        </td>
                                        <td>
                                            <select class="form-control" name="field_type" id="field_type"
                                                style="width: 260px">
                                                <option>String</option>
                                                <option>Integer</option>
                                                <option>Select</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Length:
                                        </td>
                                        <td>
                                            <input type="name" class="form-control" name="field_size" id="field_size"
                                                placeholder="Enter name" style="width: 260px">
                                        </td>
                                        <td>
                                            Description:
                                        </td>
                                        <td>
                                            <input type="name" class="form-control" name="field_description"
                                                id="field_description" placeholder="Enter name" style="width: 260px">
                                            <input type="hidden" name="form_meta_id" value="{{ Request::segment(2) }}" />
                                        </td>
                                        <td colspan="2">
                                            <button type="submit" class="">Add</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="6">
                                            <hr style="width: 100%;" />
                                        </td>
                                    </tr>
                                </table>
                            </form>
                        </fieldset>
                        <br>
                        @foreach ($fields as $key => $field)
                            <div style="width: 100%; background-color: white; padding-bottom: 10px; margin-bottom: 10px;">
                                <span class="btn btn-info fieldname">{{ $field->field_label }}</span><br />
                                <span class="btn btn-primary">Label</span> <span class="btn btn-secondary">{{ $field->field_label }}</span>
                                <span class="btn btn-primary">Name</span> <span class="btn btn-secondary">{{ $field->field_name }}</span>
                                <span class="btn btn-primary">Type</span> <span class="btn btn-secondary">{{ $field->field_type }}</span>
                                <span class="btn btn-primary">Size</span> <span class="btn btn-secondary">{{ $field->field_size }}</span>
                            </div>
                        @endforeach
                    @else
                        <h3>No Form Selected </h3>
                    @endif
                </div>

            </div>
            <!-- New Form Modal -->
            <div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="NewProjectModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="NewProjectModalLabel">New Project</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="/createnewform/" method="post" class="new_project_form">
                                @csrf
                                <p>
                                    <label for="id_form_name">Form name:</label>
                                    <input type="text" name="form_name" maxlength="80" required id="id_form_name">
                                </p>
                                <p>
                                    <label for="id_form_description">Form description:</label>
                                    <input type="text" name="form_description" maxlength="160" required
                                        id="id_form_description">
                                </p>
                                <p>
                                    <label for="id_form_country">Form country:</label>
                                    <input type="text" name="form_country" maxlength="40" required
                                        id="id_form_country">
                                </p>
                                <p>
                                    <label for="id_form_field">Form field:</label>
                                    <input type="text" name="form_field" maxlength="80" required id="id_form_field">
                                </p>
                                <button type="submit" class="btn btn-primary">Create</button>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Preview Form Modal -->
            <div class="modal fade" id="previewModal" tabindex="-1" aria-labelledby="previewModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="previewModalLabel">
                                <strong>Preview Form</strong><br>
                                <span style="font-size: 18px;">
                                    @if (isset($form_id))
                                        {{ $form_id->form_name }}
                                    @endif
                                </span>
                            </h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <table
                                style="width: 100%; background-color: white; padding-bottom: 10px; margin-bottom: 10px;">
                                @if (isset($fields))
                                    @foreach ($fields as $key => $field)
                                        <tr style="width: 100%;">
                                            <td style="width: 100%;">{{ $field->field_label }}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 100%;">
                                                <input type="text" value="" name="{{ $field->field_name }}"
                                                    style="width: 100%;"
                                                />
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Validate</button>
                        </div>
                    </div>
                </div>
            </div>
    </main>
@endsection
