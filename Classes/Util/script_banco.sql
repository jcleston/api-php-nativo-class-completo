-- public.tokens_autorizados definition

-- Drop table

-- DROP TABLE public.tokens_autorizados;

CREATE TABLE public.tokens_autorizados (
	id int8 NOT NULL DEFAULT nextval('token_autorizados_id_seq'::regclass),
	"token" varchar NOT NULL,
	status bool NULL,
	CONSTRAINT token_autorizados_pk PRIMARY KEY (id),
	CONSTRAINT token_autorizados_un UNIQUE (token)
);

-- public.usuarios definition

-- Drop table

-- DROP TABLE public.usuarios;

CREATE TABLE public.usuarios (
	id bigserial NOT NULL,
	login varchar NOT NULL,
	senha varchar NOT NULL,
	CONSTRAINT usuarios_pk PRIMARY KEY (id),
	CONSTRAINT usuarios_un UNIQUE (login)
);