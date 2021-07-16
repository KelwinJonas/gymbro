<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

@if (isset($exercicios))
    <table>
        @foreach($exercicios as $exercicio)
            <tr>
                <td><input {{ $exercicio->value ? 'checked' : null }} data-id="{{ $exercicio->id }}" type="checkbox" class="exercicio-enable"></td>
                <td>{{ $exercicio->nome }}</td>
                <td><input value="{{ $exercicio->value ?? null }}" {{ $exercicio->value ? null : 'disabled' }} data-id="{{ $exercicio->id }}" name="exercicios[{{ $exercicio->id }}]" type="text" class="exercicio-serie form-control" placeholder="Séries"></td>
            </tr>
        @endforeach
    </table>
@endif

    <script>
        $('document').ready(function () {
            $('.exercicio-enable').on('click', function () {
                let id = $(this).attr('data-id')
                let enabled = $(this).is(":checked")
                $('.exercicio-serie[data-id="' + id + '"]').attr('disabled', !enabled)
                $('.exercicio-serie[data-id="' + id + '"]').val(null)
            })
        });
    </script>

