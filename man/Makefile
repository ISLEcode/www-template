SSH_IDENT  = -i ~/.ssh/aws-primary-rsa
SSH_HOST   = centurion@saminfo-new
QRCODE_DIR = /usr/local/saminfo/var/cms/pdf/gp_saminfo/QR_Code/

all:
	scp $(SSH_IDENT) $(SSH_HOST):$(QRCODE_DIR)/* .
