package br.cefetmg.em.util;

import java.util.ArrayList;

import org.springframework.stereotype.Component;

import br.cefetmg.em.domain.Bimestre;

@Component
public class BimestreUtil {
	

	ArrayList<Bimestre> bimestres = BimestreUtil.getBimestres();
	
	
	
	public ArrayList<Bimestre> getBimestresAteAtual(int bimAtual){
		ArrayList<Bimestre> resultado = new ArrayList<Bimestre>();
		
		for(int i = 1; i <= bimAtual; i++){
			resultado.add( bimestres.get(i) );
		}
		
		if(bimAtual == 2 || bimAtual == 3 )
			resultado.add(bimestres.get(5));

		if(bimAtual == 4){
			resultado.add(bimestres.get(5));
			resultado.add(bimestres.get(6));
		}
		
		
		return resultado;
	}
	
	public int getMediaNotaDistribuido(int bimAtual){
		
		int idBimestreAtual = bimAtual;
		int mediaTotalDistribuido = 0;
		
		for(int i = 1; i <= idBimestreAtual; i++){
			Bimestre bim = bimestres.get(i);
			mediaTotalDistribuido += bim.getMedia();
		}
		
				
		return mediaTotalDistribuido;
	}
	
	public int getNotalAlertaVermelho(int bimAtual){
		int idBimestreAtual = bimAtual;
		int alertaVermelho = 0;
		
		for(int i = 1; i <= idBimestreAtual; i++){
			Bimestre bim = bimestres.get(i);
			alertaVermelho += bim.getSinalVermelho();
		}
		
		return alertaVermelho;
	}
	
	public static ArrayList<Bimestre> getBimestres(){
		
		ArrayList<Bimestre> bimestre = new ArrayList<Bimestre>();
		bimestre.add(new Bimestre(0,"Ano", 100, 60, 54));
		bimestre.add(new Bimestre(1,"1 Bimestre", 20, 12, 10));
		bimestre.add(new Bimestre(2,"2 Bimestre", 30, 18, 16));
		bimestre.add(new Bimestre(3,"3 Bimestre", 20, 12, 10));
		bimestre.add(new Bimestre(4,"4 Bimestre", 30, 18, 16));
		bimestre.add(new Bimestre(5,"AS1", 12, 7, 5));
		bimestre.add(new Bimestre(6,"AS2", 12, 7, 5));
		
		
		return bimestre;
	
	}

}
