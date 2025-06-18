<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <title>Restablecer contraseña</title>
  </head>
  <body style="margin: 0; padding: 0; background-color: #0f172a; font-family: Arial, sans-serif; color: #e2e8f0;">
    <div style="max-width: 600px; margin: auto; background-color: #1e293b; padding: 40px; border-radius: 12px; box-shadow: 0 10px 25px rgba(0,0,0,0.2);">
      
      <div style="text-align: center; margin-bottom: 30px;">
        <div style="font-size: 48px; color: #facc15;">🔐</div>
        <h2 style="font-size: 24px; font-weight: bold; color: #67e8f9; margin: 0;">Recuperación de Contraseña</h2>
        <p style="color: #cbd5e1; margin-top: 8px;">Recibiste este correo porque solicitaste restablecer tu contraseña.</p>
      </div>

      <div style="text-align: center; margin: 40px 0;">
        <a href="{{ $url }}"
          style="background-color: #facc15; color: #1e293b; padding: 14px 24px; border-radius: 8px; text-decoration: none; font-weight: bold; display: inline-block;">
          Restablecer Contraseña
        </a>
      </div>

      <p style="color: #94a3b8; font-size: 14px;">
        Si no solicitaste esta recuperación, puedes ignorar este mensaje. Tu contraseña actual no se modificará.
      </p>

      <hr style="margin: 40px 0; border: none; border-top: 1px solid #334155;">
      <p style="text-align: center; font-size: 12px; color: #64748b;">
        &copy; {{ date('Y') }} Constructora Dipconsa. Todos los derechos reservados.
      </p>

    </div>
  </body>
</html>
