package br.cefetmg.em.domain;

import java.io.Serializable;

public class Bimestre implements Serializable {
	
	/**
	 * 
	 */
	private static final long serialVersionUID = 1L;
	
	private int idBimestre;
	private String texto;
	private int total;
	private int media;
	private int notaAlerta;
	private int sinalVermelho;
	
	
	public Bimestre(int idBimestre, String texto, int total, int media, int vermelho){
		
		this.idBimestre = idBimestre;
		this.texto = texto;
		this.total = total;
		this.media = media;
		this.sinalVermelho = vermelho;
		
	}
	
	
	
	public int getNotaAlerta() {
		return notaAlerta;
	}



	public void setNotaAlerta(int notaAlerta) {
		this.notaAlerta = notaAlerta;
	}



	public int getSinalVermelho() {
		return sinalVermelho;
	}



	public void setSinalVermelho(int sinalVermelho) {
		this.sinalVermelho = sinalVermelho;
	}



	public int getTotal() {
		return total;
	}



	public void setTotal(int total) {
		this.total = total;
	}



	public int getMedia() {
		return media;
	}



	public void setMedia(int media) {
		this.media = media;
	}



	public int getIdBimestre() {
		return idBimestre;
	}
	public void setIdBimestre(int idBimestre) {
		this.idBimestre = idBimestre;
	}
	public String getTexto() {
		return texto;
	}
	public void setTexto(String texto) {
		this.texto = texto;
	}
	
//	@Override
//	public String toString(){
//		
//		return this.texto;
//		
//	}
	
	

}
