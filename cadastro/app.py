import smtplib
from flask import Flask, request, jsonify

app = Flask(__name__)

@app.route('/enviar_email', methods=['POST'])
def enviar_email():
    try:
        nome = request.form['nome']
        email = request.form['email']
        mensagem = request.form['mensagem']

        # Configurações do servidor SMTP
        smtp_server = 'smtp.gmail.com'
        smtp_port = 587
        smtp_username = 'caiogame455@gmail.com'
        smtp_password = 'aranha3d'
        
        # Cria a mensagem
        message = f"Subject: Nova Mensagem de Contato\n\nNome: {nome}\nEmail: {email}\nMensagem: {mensagem}"

        # Envia o e-mail
        with smtplib.SMTP(smtp_server, smtp_port) as server:
            server.starttls()  # Usar TLS
            server.login(smtp_username, smtp_password)
            server.sendmail(smtp_username, smtp_username, message)

        return jsonify({'success': True}), 200
    except Exception as e:
        print(f'Erro: {e}')  # Log do erro
        return jsonify({'success': False, 'error': str(e)}), 500

if __name__ == '__main__':
    app.run(debug=True)
